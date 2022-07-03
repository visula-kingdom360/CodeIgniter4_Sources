<?php
namespace App\Controllers\Traits\DB;

use App\Models\Genre;

trait OtherTrait {
    public function getGenreDataviaID($genreID)
    {
        $genre = [];

        $genreModule = new Genre();

        # Genre data from DB directly
        $genreDBData = $genreModule->selectGenrebyID($genreID);

        # Converting the DB Data to an Array
        $this->genre = $this->pushModelDBDataToArrayReturn($genreModule, $genreDBData);

        return $this->genre;
    }
}
?>