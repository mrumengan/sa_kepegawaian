<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Test controller
 */
class InitController extends Controller
{

    private $folders = ['pdf', 'doc', 'img'];
    public function actionIndex()
    {
        echo "Inisiasi path media\n";
        foreach ($this->folders as $folder) {
            if (!$this->createFolder($folder)) {
                echo 'Gagal membut ' . $folder;
                exit;
            }
        }
    }

    private function createFolder($folder)
    {
        if (is_dir(Yii::getAlias('@frontend') . '/web/media/' . $folder)) {
            echo "Folder " . strtoupper($folder) . " sudah ada\n";
            return 1;
        } else {
            echo "Folder " . strtoupper($folder) . " belum ada.. membuat..\n";
            $isDone = mkdir(Yii::getAlias('@frontend') . '/web/media/' . $folder, '0777', true);
            if ($isDone) {
                echo "\tBerhasil.. \n";
            }
            return $isDone;
        }
    }

    public function actionMail($to)
    {
        echo "Sending mail to " . $to;
    }
}
