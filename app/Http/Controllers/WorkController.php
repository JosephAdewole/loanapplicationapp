<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;


class WorkController extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }
    public function index()
    {
        // if(!request('year')) {
        //     die("year required");
        // }

        $this->soapWrapper->add('Baseurl', function ($service) {
            $service
                ->wsdl('http://www.dneonline.com/calculator.asmx?wsdl')
                ->trace(true);
        });
        $results = $this->soapWrapper->call('Baseurl.Subtract', [[
            'intA' => 2020,
            'intB' => 20,
        ]]);

        dd($results->SubtractResult);
        echo "<pre>";
        foreach ($results->holiday as $result) {
            echo "<strong>" . $result->name->text . "</strong>: " . $result->holidayType . "(" . $result->date->day . '/' . $result->date->month . '/' . $result->date->year . ")" . "<br/>";
        }
        echo "</pre>";
    }
}