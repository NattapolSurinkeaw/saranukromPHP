<?php

class BackendController extends Controller {
  public function dashboardPage() {
    $mangaModel = $this->model("Manga");
    $mangas = $mangaModel->getMangaAll();
    $tagModel = $this->model("MangaTag");
    $tags = $tagModel->getMangaTagAll();
    $authorModel = $this->model("Author");
    $author = $authorModel->getAuthorAll();
    $this->view('backoffice/dashboard', ['mangas' => $mangas, 'tags' => $tags, 'author' => $author]);
  }

  public function manageEpisode($id) {
    $episodeModel = $this->model("MangaEpisode");
    $episodes = $episodeModel->getEpisodeManga($id);
    $this->view('backoffice/manageEpisode', ['id' => $id, 'episodes' => $episodes]);
  }

  public function manageImage($id) {
    $imageModel = $this->model("MangaImage");
    $images = $imageModel->getImageByEpid($id);
    $this->view('backoffice/manageImage', ['id' => $id, "images" => $images]);
  }

  public function tagPage() {
    $this->view('backoffice/createTagPage');
  }

  public function authorPage() {
    $this->view('backoffice/createAuthorPage');
  }

  public function createManga() {
    $param = $_POST;
    $mangaModel = $this->model("Manga");
    $mangaModel->createNewManga($param);
    header("Location:/backend/dashboard");
  }

  public function deleteManga($id) {
    print_r($id);
    $mangaModel = $this->model("Manga");
    $mangaModel->deleteManga($id);
    header("Location:/backend/dashboard");
  }

  public function createNewEpisode($id) {
    $param = $_POST;
    $param['id'] = $id;
    $episodeModel = $this->model("MangaEpisode");
    $episodes = $episodeModel->createNewEpisode($param);
    header("Location:/backend/manageEpisode/$id");
  }

  public function deleteEpisode($id, $manga_id) {
    $episodeModel = $this->model("MangaEpisode");
    $episodeModel->deleteEp($id);
    header("Location:/backend/manageEpisode/$manga_id");
  }

  public function addNewImage($id) {
    $param = $_POST;
    $param['id'] = $id;

    $imageModel = $this->model("MangaImage");
    $images = $imageModel->addNewImage($param);
    header("Location:/backend/manageImage/$id");
  }

  public function createTag() {
    $tagModel = $this->model("MangaTag");
    $tag = $tagModel->createMangaTag($_POST);
    header("Location:/backend/dashboard");
  }

  public function createAuthor() {
    $authorModel = $this->model("Author");
    $author = $authorModel->createAuthor($_POST);
    header("Location:/backend/dashboard");
  }

}

?>