<?php

use Illuminate\Database\Seeder;
use App\Qcm;
use App\Question;
use App\Choice;

class QcmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/qcms.json");
        $datas = json_decode($json);

        foreach($datas->qcms as $obj) {

            $qcm = new Qcm();

            $qcm->title = $obj->title;
            $qcm->class_level = $obj->class_level;

            $qcm->save();

            foreach($obj->questions as $question) {

                $newQuestion = new Question();

                $newQuestion->question = $question->question;

                $qcm->questions()->save($newQuestion);

                foreach($question->choices as $choice) {

                    $newChoice = new Choice();

                    $newChoice->content = $choice->content;
                    $newChoice->valid = $choice->valid;

                    $newQuestion->choices()->save($newChoice);

                }
            }
        }
    }
}
