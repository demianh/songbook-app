<?php

class SongIndex {

	private $DB;

	function __construct($id = null) {
		$this->DB = $GLOBALS['DB'];
	}

	public function getSongIndex(){
		$songs = $this->DB->fetchAll("SELECT 
				 id, title, license, status, 
				 (rawImage IS NOT NULL) AS hasImage,
				 (rawSIB IS NOT NULL) AS hasSIB,
				 (rawMidi IS NOT NULL) AS hasMidi,
				 (rawNotesPDF IS NOT NULL) AS hasNotesPDF
				FROM songs");

		return $songs;
	}

	public function getSongIndexForApp(){
		$index = [];

		$songs = $this->DB->fetchAll("SELECT id
			FROM songs
			WHERE license = 'FREE'
			AND status = 'DONE'");

		foreach($songs as $song_id){
			$model = new Song($song_id['id']);
			$song = $model->getData();
			$alternativeTitles = $song['alternativeTitles'];
			$title_uc = mb_convert_case($song['title'], MB_CASE_UPPER, "UTF-8");

			// accords
			$chords = $model->getChordList();

			$index[] = [
				'id' => $song['id'],
				'title' => $title_uc,
				'pageRondoRed' => $song['pageRondoRed'],
				'pageRondoBlue' => $song['pageRondoBlue'],
				'pageRondoGreen' => $song['pageRondoGreen'],
				'chords' => $chords,
				'alternative' => false
			];

			// alternative titel
			if (strlen($alternativeTitles) > 0){
				$titles = explode("\n", $alternativeTitles);
				foreach($titles as $title){
					$index[] = [
						'id' => $song['id'],
						'title' => $title,
						'pageRondoRed' => $song['pageRondoRed'],
						'pageRondoBlue' => $song['pageRondoBlue'],
						'pageRondoGreen' => $song['pageRondoGreen'],
						'chords' => $chords,
						'alternative' => true
					];
				}
			}
		}
		return $index;
	}
}