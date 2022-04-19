<?php

namespace App\Controllers;

use App\Models\Episode;
use App\Models\Genre;
use App\Models\Story;
use App\Models\Category;
use App\SessionGuard as Guard;

class DashboardController extends Controller
{
	protected $data;
	public function __construct()
	{

		parent::__construct();
		$this->data = [];
	}

	public function index()
	{
		$stories = Story::where("status", 1)->get();
		foreach ($stories as $story) {

			$genres = Genre::where("story_id", $story->id)->get();
			foreach ($genres as $genre) {
				$categories[] = Category::where("id", $genre->category_id)->get()[0]->category_name;
			}

			$this->data['stories'][] = [
				"info" => $story,
				"categories" => $categories,
				"quantily_ep" => Episode::where("story_id", $story->id)->count(),
			];
		}

		$this->sendPage('dashboard/stories_management', $this->data);
	}
	public function add_story()
	{
		$this->data["categories"] = Category::where("category_status", 1)->get();
		$this->sendPage('dashboard/forms/add_story', $this->data);
	}
}