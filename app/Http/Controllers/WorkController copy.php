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

        $this->soapWrapper->add('Holidays', function ($service) {
            $service
                ->wsdl('http://kayaposoft.com/enrico/ws/v2.0/index.php?wsdl')
                ->trace(true);
        });
        $results = $this->soapWrapper->call('Holidays.getHolidaysForYear', [[
            // 'year' => request('year')
            'year' => 2020,
            // 'country' => 'Nigeria'

        ]]);

        dd($results);
        echo "<pre>";
        foreach ($results->holiday as $result) {
            echo "<strong>" . $result->name->text . "</strong>: " . $result->holidayType . "(" . $result->date->day . '/' . $result->date->month . '/' . $result->date->year . ")" . "<br/>";
        }
        echo "</pre>";
    }
}