<?php

namespace App\Controllers;

use App\Models\Episode;
use App\Models\Genre;
use App\Models\Story;
use App\Models\Category;
use App\SessionGuard as Guard;

class HomeController extends Controller
{

	protected $data;
	public function __construct()
	{

		parent::__construct();
		$this->data["categories"] = Category::where("category_status", 1)->get();
	}
	public function search()
	{

		if (isset($_POST["search"])) {
			$text = $_POST["keyword"];
			$text = explode(" ", $text);
			$x = Story::where("story_name", "like", "%" . $text[0] . "%");
			foreach ($text as $i => $t) {
				if ($i != 0) {
					$x = $x->orWhere("story_name", "like", "%" . $t . "%");
				}
			}
			$x = $x->where("status", 1)->get();

			$now = Story::where("id", "<>", $x[0]->id);
			foreach ($x as $i => $a) {
				if ($i != 0) {
					$now = $now->where("id", "<>",  $a->id);
				}
			}
			$z = $now->get();
			foreach ($x as $a) {
				$stories[] = $a;
			}
			foreach ($z as $a) {
				$stories[] = $a;
			}
			$this->data['menu_page'] = [
				'quantily_page' => 1,
				"active_page" => 1,
			];
			foreach ($stories as $story) {

				$this->data['stories'][] = [
					"info" => $story,
					"count_ep" => Episode::where("story_id", $story->id)->count(),
				];
			}

			$this->sendPage('home', $this->data);
		} else {
			$this->index();
		}
	}
	public function index(string $page = null)
	{
		if ($page == null) {
			$page = "1";
		} else {
			$page = str_replace("trang-", "", $page);
		}
		$page = (int) $page - 1;
		$stories = Story::where("status", 1)->orderBy("id", "DESC")->skip($page * 30)->take($page * 30 + 30)->get();
		$this->data['menu_page'] = [
			'quantily_page' => ceil(Story::where("status", 1)->count() / 30),
			"active_page" => $page + 1,
		];
		foreach ($stories as $story) {

			$this->data['stories'][] = [
				"info" => $story,
				"count_ep" => Episode::where("story_id", $story->id)->count(),
			];
		}

		$this->sendPage('home', $this->data);
	}
	public function detail(string $slug = null)
	{
		$story = Story::where("story_slug", $slug)->get()[0];
		$genres = Genre::where("story_id", $story->id)->get();
		foreach ($genres as $g) {
			$categories[] = Category::where("id", $g->category_id)->get()[0];
		}
		$this->data['stories'] = [
			"info" => $story,
			"count_ep" => Episode::where("story_id", $story->id)->count(),
			"eps" => Episode::where("story_id", $story->id)->get(),
			"categories" => $categories,
		];

		$this->sendPage('auth/story_detail', $this->data);
	}
	public function read(string $slug = null)
	{
		$ep = Episode::where("slug", $slug)->get()[0];
		$story = Story::where("id", $ep->story_id)->get()[0];

		$this->data['stories'] = [
			"info" => $story,
			"eps" => Episode::where("story_id", $story->id)->get(),
			"this_ep" => $ep,
		];
		$this->sendPage('auth/watch', $this->data);
	}
}