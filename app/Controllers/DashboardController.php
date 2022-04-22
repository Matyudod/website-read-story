<?php

namespace App\Controllers;

use App\Models\Episode;
use App\Models\Genre;
use App\Models\Story;
use App\Models\Category;
use App\SessionGuard as Guard;
use GMP;

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
			unset($categories);
		}

		$this->sendPage('dashboard/stories_management', $this->data);
	}
	public function add_story()
	{
		$this->data["categories"] = Category::where("category_status", 1)->get();
		$this->sendPage('dashboard/forms/add_story', $this->data);
	}
	public function handle_add_story()
	{
		if (isset($_POST['addStory'])) {
			function vn_str_filter($str)
			{
				$unicode = array(
					'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
					'd' => 'đ',
					'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
					'i' => 'í|ì|ỉ|ĩ|ị',
					'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
					'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
					'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
					'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
					'D' => 'Đ',
					'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
					'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
					'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
					'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
					'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
				);

				foreach ($unicode as $nonUnicode => $uni) {
					$str = preg_replace("/($uni)/i", $nonUnicode, $str);
				}
				return $str;
			}
			extract($_POST);
			// convert name to slug
			$slug = strtolower(str_replace(" ", "-", vn_str_filter($name)));
			$slug = preg_replace('/[^a-z^0-9^-]/', '', $slug);
			while (strpos(" " . $slug, "--")) {
				$slug = str_replace("--", "-", $slug);
			}
			if (stripos(" " . $slug, "-") == 1) {
				$slug = substr($slug, 1, strlen($slug) - 1);
			}
			// explode categories
			$categories = substr($categories, 0, strlen($categories) - 1);
			$categories = explode(";", $categories);
			foreach ($categories as $category) {
				$cate[] = Category::where("category_name", trim($category))->get()[0]->id;
			}
			foreach ($cate as $category) {
				echo $category . "<br>";
			}
			if (Story::where("story_name", $name)->count() == 0) {
				if (isset($use_link)) {
					$poster = $link;
				} else {
					$poster = "/imgs/uploads/" . $_FILES['image']['name'][0];
				}
				if (!isset($use_link)) {
					if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $poster)) {
						move_uploaded_file($_FILES['image']['tmp_name'][0], $_SERVER["DOCUMENT_ROOT"] . $poster);
					}
				}
				$id = Story::insertGetId([
					"story_name" => $name,
					"story_background" => $poster,
					"story_description" => $decription,
					"story_slug" => $slug,
				]);
				foreach ($cate as $category_id) {
					Genre::create([
						"story_id" => $id,
						"category_id" => $category_id,
					]);
				}
			}
		}
		redirect("/quan-ly", []);
	}
	public function update_story(string $slug = null)
	{
		$this->data['story'] = Story::where("story_slug", $slug)->get()[0];

		$genre = Genre::where("story_id", $this->data['story']->id)->get();

		$this->data['genre'] = "";
		foreach ($genre as $ge) {
			$this->data['genre'] .= Category::where("id", $ge->category_id)->get()[0]->category_name;
			$this->data['genre'] .= ";";
		}
		$this->data["categories"] = Category::where("category_status", 1)->get();
		$this->sendPage('dashboard/forms/update_story', $this->data);
	}
	public function handle_update_story(string $slug = null)
	{
		if (isset($_POST['updateStory'])) {
			function vn_str_filter($str)
			{
				$unicode = array(
					'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
					'd' => 'đ',
					'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
					'i' => 'í|ì|ỉ|ĩ|ị',
					'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
					'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
					'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
					'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
					'D' => 'Đ',
					'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
					'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
					'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
					'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
					'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
				);

				foreach ($unicode as $nonUnicode => $uni) {
					$str = preg_replace("/($uni)/i", $nonUnicode, $str);
				}
				return $str;
			}
			extract($_POST);
			// convert name to slug
			$slug = strtolower(str_replace(" ", "-", vn_str_filter($name)));
			$slug = preg_replace('/[^a-z^0-9^-]/', '', $slug);
			while (strpos(" " . $slug, "--")) {
				$slug = str_replace("--", "-", $slug);
			}
			if (stripos(" " . $slug, "-") == 1) {
				$slug = substr($slug, 1, strlen($slug) - 1);
			}
			// explode categories
			$categories = substr($categories, 0, strlen($categories) - 1);
			$categories = explode(";", $categories);
			foreach ($categories as $category) {
				$cate[] = Category::where("category_name", trim($category))->get()[0]->id;
			}

			if (isset($use_link)) {
				$poster = $link;
			} else {
				$poster = "/imgs/uploads/" . $_FILES['image']['name'][0];
			}
			if (!isset($use_link)) {
				if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $poster)) {
					move_uploaded_file($_FILES['image']['tmp_name'][0], $_SERVER["DOCUMENT_ROOT"] . $poster);
				}
			}
			Story::where("id", $id)->update([
				"story_name" => $name,
				"story_background" => $poster,
				"story_description" => $decription,
				"story_slug" => $slug,
			]);
			Genre::where("story_id", $id)->delete();
			foreach ($cate as $category_id) {
				Genre::create([
					"story_id" => $id,
					"category_id" => $category_id,
				]);
			}
			$eps = Episode::where("story_id", $id)->get();
			foreach ($eps as $ep) {
				$ep->update([
					"slug" => $slug . "-chap-" . $ep->episode,
				]);
			}
		}
		redirect("/quan-ly", []);
	}
	public function handle_delete_story(string $slug = null)
	{
		$this->data['story'] = Story::where("story_slug", $slug)->update([
			"status" => 0,
		]);
		redirect("/quan-ly", []);
	}
	public function chapter(string $slug = null)
	{
		$this->data['story'] = Story::where("story_slug", $slug)->get()[0];
		$this->data['eps'] = Episode::where("story_id", $this->data['story']->id)->get();
		$this->sendPage('dashboard/chapter_management', $this->data);
	}
	public function add_chapter(string $slug = null)
	{

		$this->data['story'] = Story::where("story_slug", $slug)->get()[0];
		$this->data['ep'] = Episode::where("story_id", $this->data['story']->id)->count() + 1;
		$this->sendPage('dashboard/forms/add_chapter', $this->data);
	}
	public function handle_add_chapter(string $ep_slug = null)
	{
		if (isset($_POST['addChapter'])) {

			extract($_POST);
			$story = Story::where("id", $story_id)->get()[0];
			$ep = Episode::where("story_id", $story_id)->count() + 1;
			$slug = $story->story_slug . "-chap-" . $ep;
			$content = nl2br($content);

			Episode::create([
				"story_id" => $story_id,
				"episode" => $ep,
				"episode_name" => $name,
				"content" => $content,
				"slug" => $slug,
			]);
		}
		redirect("/quan-ly/danh-sach-chapter/" . $ep_slug, []);
	}
	public function update_chapter(string $ep_slug = null)
	{
		$this->data['episode'] = $episode = Episode::where("slug", $ep_slug)->get()[0];
		$this->data['story'] = Story::where("id", $episode->story_id)->get()[0];

		$this->sendPage('dashboard/forms/update_chapter', $this->data);
	}
	public function handle_update_chapter(string $ep_slug = null)
	{
		extract($_POST);
		$name = trim($name);
		$content = nl2br($content);
		$slug = Story::where("id", $story_id)->get()[0]->story_slug;
		Episode::where("story_id", $story_id)->where("episode", $ep)->update([
			"episode_name" => $name,
			"content" =>  $content,
			"status" =>  1,
		]);
		redirect("/quan-ly/danh-sach-chapter/" . $slug, []);
	}
	public function handle_delete_chapter(string $ep_slug = null)
	{
		$slug = Story::where("id", Episode::where("slug", $ep_slug)->get()[0]->story_id)->get()[0]->story_slug;
		Episode::where("slug", $ep_slug)->update([
			"status" =>  0,
		]);
		redirect("/quan-ly/danh-sach-chapter/" . $slug, []);
	}


	public function category_management()
	{
		$this->data['categories'] = Category::where("category_status", 1)->get();
		$this->sendPage('dashboard/category_management', $this->data);
	}

	public function add_category()
	{
		$this->sendPage('dashboard/forms/add_category', $this->data);
	}
	public function handle_add_category()
	{
		if (isset($_POST['addCategory'])) {
			$name = $_POST['name'];
			if (Category::where("category_name", $name)->where("category_status", 1)->count() == 0) {
				function vn_str_filter($str)
				{
					$unicode = array(
						'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
						'd' => 'đ',
						'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
						'i' => 'í|ì|ỉ|ĩ|ị',
						'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
						'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
						'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
						'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
						'D' => 'Đ',
						'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
						'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
						'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
						'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
						'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
					);

					foreach ($unicode as $nonUnicode => $uni) {
						$str = preg_replace("/($uni)/i", $nonUnicode, $str);
					}
					return $str;
				}
				$slug = strtolower(str_replace(" ", "-", vn_str_filter($name)));
				$slug = preg_replace('/[^a-z^0-9^-]/', '', $slug);
				while (strpos(" " . $slug, "--")) {
					$slug = str_replace("--", "-", $slug);
				}
				if (stripos(" " . $slug, "-") == 1) {
					$slug = substr($slug, 1, strlen($slug) - 1);
				}
				Category::create([
					"category_name" => $name,
					"category_slug" => $slug,
				]);
			}
			redirect("/quan-ly/quan-ly-the-loai", []);
		}
	}
	public function update_category(string $slug = null)
	{
		if (Category::where("category_slug", $slug)->count())
			$this->data['category'] = Category::where("category_slug", $slug)->get()[0];
		$this->sendPage('dashboard/forms/update_category', $this->data);
	}
	public function handle_update_category(string $slug = null)
	{
		if (isset($_POST['updateCategory'])) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			if (Category::where("category_name", $name)->count() == 0) {
				function vn_str_filter($str)
				{
					$unicode = array(
						'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
						'd' => 'đ',
						'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
						'i' => 'í|ì|ỉ|ĩ|ị',
						'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
						'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
						'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
						'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
						'D' => 'Đ',
						'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
						'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
						'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
						'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
						'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
					);

					foreach ($unicode as $nonUnicode => $uni) {
						$str = preg_replace("/($uni)/i", $nonUnicode, $str);
					}
					return $str;
				}
				$slug = strtolower(str_replace(" ", "-", vn_str_filter($name)));
				$slug = preg_replace('/[^a-z^0-9^-]/', '', $slug);
				while (strpos(" " . $slug, "--")) {
					$slug = str_replace("--", "-", $slug);
				}
				if (stripos(" " . $slug, "-") == 1) {
					$slug = substr($slug, 1, strlen($slug) - 1);
				}
				Category::where("id", $id)->update([
					"category_name" => $name,
					"category_slug" => $slug,
				]);
			}
			redirect("/quan-ly/quan-ly-the-loai", []);
		}
	}

	public function handle_delete_category(string $slug = null)
	{
		Category::where("category_slug", $slug)->update([
			"category_status" => 0,
		]);
		redirect("/quan-ly/quan-ly-the-loai", []);
	}
}