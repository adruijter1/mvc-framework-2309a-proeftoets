<?php

class Zangeressen extends BaseController
{
    private $zangeresModel;

    public function __construct()
    {
        $this->zangeresModel = $this->model('Zangeres');
    }

    public function index()
    {
        $zangeressen = $this->zangeresModel->getZangeressen();
        
        // var_dump($zangeressen);exit();

        $dataRows = "";

        foreach ($zangeressen as $zangeres) {
            $dataRows .= "<tr>
                            <td>{$zangeres->Naam}</td>
                            <td>{$zangeres->NettoWaarde}</td>
                            <td>{$zangeres->Land}</td>
                            <td>{$zangeres->Mobiel}</td>
                            <td>{$zangeres->Leeftijd}</td>  
                            <td class='text-center'>
                                <a href='" . URLROOT . "/Zangeressen/delete/{$zangeres->Id}'>
                                    <i class='bi bi-trash'></i>
                                </a>                                
                            </t>          
                        </tr>";
        }

        $data = [
            'title' => 'De Top 5 rijkste zangeressen ter wereld',
            'dataRows' => $dataRows
        ];

        $this->view('zangeressen/index', $data);
    }

    public function delete($zangeresId)
    {
        $result = $this->zangeresModel->deleteZangeres($zangeresId);

        $data = [
            'message' => 'De zangeres is verwijderd. U wordt teruggestuurd naar de lijst met zangeressen.'
        ];


        header("Refresh:3; url=" . URLROOT . "/Zangeressen/index");

        $this->view('zangeressen/delete', $data);
    }
}