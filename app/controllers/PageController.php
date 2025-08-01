<?php
require_once "../app/core/Controller.php"; 

class PageController extends Controller {
    public function home() {
        $month = isset($_GET['month']) ? $_GET['month'] : date('n');
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

        if (!is_numeric($month) || $month < 1 || $month > 12) {
            $month = date('n');
        }

        $currentYear = date('Y');
        if (!is_numeric($year) || strlen($year) != 4 || $year < 2000 || $year > $currentYear + 1) {
            $year = $currentYear;
        }

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $firstDayOfWeek = date('w', strtotime("$year-$month-01"));
        $today = date('Y-m-d');

        // เดือนก่อนหน้าและถัดไป
        $prevMonth = $month - 1;
        $nextMonth = $month + 1;
        $prevYear = $nextYear = $year;

        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        $publishModel = $this->model("Publisher");
        $publishers = $publishModel->getPublisherAll();

        $mangaModel = $this->model("Manga");
        $mangas = $mangaModel->getMangaAll();

        $publishersByDate = [];
        $mangaByDate = [];

        print_r($publishers);
        foreach ($mangas as $manga) {
            $date = $manga['lc_date'];
            $pubId = $manga['publish_id'];

            $mangaByDate[$date][] = $manga;
            
            if (!isset($publishersByDate[$date][$pubId]) && array_key_exists($pubId, $publishers)) {
                $publishersByDate[$date][$pubId] = $publishers[$pubId];
            }
        }
        print_r($publishersByDate);

        $this->view("home", [
            "month" => $month, 
            "prevMonth" => $prevMonth, 
            "nextMonth" => $nextMonth, 
            "year" => $year, 
            "prevYear" => $prevYear, 
            "nextYear" => $nextYear,
            "daysInMonth" => $daysInMonth,
            "firstDayOfWeek" => $firstDayOfWeek,
            "today" => $today,
            "publishersByDate" => $publishersByDate,
            "mangaByDate" => $mangaByDate
        ]);
    }

    public function getManga() {
        $mangaModel = $this->model("Manga");
        $mangas = $mangaModel->getMangaByCate(2);
        $this->view("mangabycate", ["cate_title" => "Manga" ,"mangas" => $mangas]);
    }

    public function getDoujin() {
        $mangaModel = $this->model("Manga");
        $mangas = $mangaModel->getMangaByCate(3);
        $this->view("mangabycate", ["cate_title" => "Doujin", "mangas" => $mangas]);
    }

    public function getEpisodeManga($id) {
        $episodeModel = $this->model("MangaEpisode");
        $episodes = $episodeModel->getEpisodeManga($id);
        $this->view("episode", ["id" => $id, "episodes" => $episodes]);
    }
    
    public function getReadManga($ep_id) {
        $imageModel = $this->model("MangaImage");
        $images = $imageModel->getImageByEpid($ep_id);

        $episodeModel = $this->model("MangaEpisode");
        $currentEpisode = $episodeModel->getEpisodeById($ep_id);
    
        if (!$currentEpisode) {
            return false; // ถ้าไม่มีตอนนี้ ให้คืนค่า false
        }
        
        $manga_id = $currentEpisode['manga_id']; // เอาค่า manga_id
        
        // ดึงตอนถัดไปและตอนก่อนหน้า
        $nextEpisode = $episodeModel->getNextEpisode($manga_id, $ep_id);
        $prevEpisode = $episodeModel->getPrevEpisode($manga_id, $ep_id);
        $this->view("reading", ["id" => $ep_id, 'images' => $images, "nextEpisode" => $nextEpisode, "prevEpisode" => $prevEpisode]);
    }

    public function searchPage() {
        $mangaTag = $this->model("MangaTag");
        $tags = $mangaTag->getMangaTagAll();
        $mangaModel = $this->model("Manga");
        $mangas = $mangaModel->getFilterManga($_POST);
        $this->view("searchPage", ["tags" => $tags, "mangas" => $mangas]);
    }


    public function about() {

        $this->view("about");
    }

    public function detaildayPage($month, $year) {

        if (!is_numeric($month) || $month < 1 || $month > 12) {
            $month = date('n'); // fallback เป็นเดือนปัจจุบัน
        }

        $currentYear = date('Y');
        if (!is_numeric($year) || strlen($year) != 4 || $year < 2000 || $year > $currentYear + 1) {
            $year = $currentYear; // fallback เป็นปีปัจจุบัน
        }

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $firstDayOfWeek = date('w', strtotime("$year-$month-01"));
        $today = date('Y-m-d');

        // หาค่าของเดือนก่อนหน้า / ถัดไป
        $prevMonth = $month - 1;
        $nextMonth = $month + 1;
        $prevYear = $nextYear = $year;

        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        $publishModel = $this->model("Publisher");
        $publishers = $publishModel->getPublisherAll();

        $mangaModel = $this->model("Manga");
        $mangas = $mangaModel->getMangaAll();

        $publishersByDate = [];
        $mangaByDate = [];

        foreach ($mangas as $manga) {
            $date = $manga['lc_date'];
            $pubId = $manga['publish_id'];

            $mangaByDate[$date][] = $manga;

            if (!isset($publishersByDate[$date][$pubId]) && array_key_exists($pubId, $publishers)) {
                $publishersByDate[$date][$pubId] = $publishers[$pubId];
            }
        }

        $this->view("detailday",[
            "month" => $month, 
            "prevMonth" => $prevMonth, 
            "nextMonth" => $nextMonth, 
            "year" => $year, 
            "prevYear" => $prevYear, 
            "nextYear" => $nextYear,
            "daysInMonth" => $daysInMonth,
            "firstDayOfWeek" => $firstDayOfWeek,
            "today" => $today,
            "publishersByDate" => $publishersByDate,
            "mangaByDate" => $mangaByDate
        ]);
    }
}
?>