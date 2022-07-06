<?php

namespace App\Controllers\Tests;

use App\Controllers\Tests\TestController;
use App\Helpers\Storage;
use App\Helpers\Thumb as HelpersThumb;
use App\Models\Auth;
use Components\Message\Message;
use Components\Session\Session;
use Components\Thumb\Thumb;

class IndexController extends TestController
{
    public function __construct($router)
    {
        parent::__contruct($router);
    }

    public function index(): void
    {
        $session = new Session();
        $session->add("user_id", 2819);

        if ($session->get("page_updates") === null) {
            $session->add("page_updates", 0);
        } else {
            $updates = $session->get("page_updates");
            $session->update("page_updates", $updates += 1);
        }
        // $session->destroy();
        // $session->remove("user_id");

        $this->view("tests/index", [
            "firstName" => "My First Name",
            "lastName" => "My Last Name"
        ])
            ->seo("Dashboard", "Lorem ipsum dolor sit nit natus unis doloren instinctus dolor lorem", $this->route("index.index"), null, false)
            ->render();
    }

    public function messageTest(): void
    {
        (new Message())->danger("Uma mensagem de perigo", "Mensagem na sessão")->float()->fixed()->flash();
        $messages = [
            "float" => (new Message())->success("Uma mensagem de sucesso fluatuante temporária por definição por 7.5s", "Flutuante temporária por 7.5s")->float()->render(),
            "wtimer" => (new Message())->success("Uma mensagem de sucesso temporária por 10s", "Temporária por 10s")->time(10)->render(),
            "wotimer" => (new Message())->success("Uma mensagem de sucesso fixa permanente", "Permanente fixa")->render(),
            "json" => (new Message())->success("Uma mensagem de sucesso json", "Mensagem em json")->float()->fixed()->json()
        ];

        $this->view("tests/message", [
            "firstName" => "My First Name",
            "lastName" => "My Last Name",
            "messages" => $messages
        ])->render();
    }

    public function uploadTest(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $upload = null;

            if (key_exists("image", $_FILES)) {
                $upload = $this->uploader->imageMimes(["image/png"])->image($_FILES["image"], "images");
            } else if (key_exists("video", $_FILES)) {
                $upload = $this->uploader->media($_FILES["video"], "medias")->mediaMimes(["video/mpg"]);
            } elseif (key_exists("file", $_FILES)) {
                $upload = $this->uploader->fileMimes(["application/pdf"])->file($_FILES["file"], "files");
            } else {
                echo "nenhum upload";
            }

            $path = $upload->store();
            if (!$path) {
                (new Message())->danger($upload->error()->message, "Falha no upload")->flash();
            } else {
                (new Message())->success("Upload concluído: " . $this->route("index.index") . "/storage/uploads" . $path . " :)", "Tudo certo :D")->flash();
            }

            $this->router->redirect("index.uploadTest");
            return;
        }

        $this->view("tests/upload", [
            "firstName" => "My First Name",
            "lastName" => "My Last Name"
        ])->seo("Teste de upload")->render();
    }

    public function uploadTestStorage(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $storage = new Storage();

            if (key_exists("image", $_FILES)) {
                $storage->image($_FILES["image"], "tests/images");
            } else if (key_exists("video", $_FILES)) {
                $storage->media($_FILES["video"], "tests/medias");
            } elseif (key_exists("file", $_FILES)) {
                $storage->file($_FILES["file"], "tests/files");
            } else {
                echo "nenhum upload";
            }

            $path = $storage->store();
            if (!$path) {
                (new Message())->danger($storage->error()->message, "Falha no upload")->flash();
            } else {
                // var_dump($storage->url("/jujubas/pebas/2022/10/218912.jpg"), $storage->path("/jujubas/pebas/2022/10/218912.jpg"));die;
                // $storage->unlinkLast();
                (new Message())->success("Upload concluído: " . $this->route("index.index") . "/storage/uploads" . $path . " :)", "Tudo certo :D")->flash();
            }

            $this->router->redirect("index.uploadTest");
            return;
        }

        $this->view("tests/upload", [
            "firstName" => "My First Name",
            "lastName" => "My Last Name"
        ])->seo("Teste de upload")->render();
    }

    public function images(): void
    {
        $logged = (new Auth())->logged();
        // THUMB COM O COMPONENTE
        // $thumb = (new Thumb(CONF_BASE_DIR . CONF_UPLOAD_BASE_DIR));

        // $path = $thumb->make(CONF_BASE_DIR . "/shared/images/tests/portrait.png", 300);
        // $path = $thumb->make(storage_path($logged->photo), 200, 200);
        // echo "<img src='" . storage_url($path) . "'>";
        // echo "<img src='" . storage_url($path) . "'>";

        // THUMB COM O HELPER
        // echo "<img src='" . storage_url(HelpersThumb::thumbExtraSmall(storage_path($logged->photo))) . "'>";
        // echo "<img src='" . storage_url(HelpersThumb::thumbSmall(storage_path($logged->photo))) . "'>";
        // echo "<img src='" . storage_url(HelpersThumb::thumbNormal(storage_path($logged->photo))) . "'>";
        // echo "<img src='" . storage_url(HelpersThumb::thumbMedium(storage_path($logged->photo))) . "'>";
        echo "<hr>";
        echo "<img src='" . storage_url(HelpersThumb::thumbNormal(storage_path($logged->photo))) . "'>";
        echo "<img src='" . storage_url(HelpersThumb::thumbLarge(storage_path($logged->photo), false)) . "'>";
        // $thumb->unmake(storage_path($logged->photo));
    }
}
