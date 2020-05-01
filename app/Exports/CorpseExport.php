<?php

namespace App\Exports;

use App\Anatomy;
use App\Corpse;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class CorpseExport implements FromCollection,WithHeadings,WithMapping
{

    public $exportCorpse=null;

    public function __construct( $corpse) {
           $this->exportCorpse= $corpse;
    }

    public function collection()
    {
           return  $this->exportCorpse;
    }


    public function storageday($pickup_date)
    {
        $now = Carbon::now();
        $pickupDate = Carbon::parse($pickup_date);
        return $now->diffInDays($pickupDate);
    }

    public function anatomy($id)
    {    
        $anatomy  = Anatomy::findOrFail($id);
        return $anatomy->anatomy;
    }

    public function map($corpse): array
    {

        return[ $corpse->id ,
                $corpse->first_name,
                $corpse->middle_name,
                $corpse->last_name ,
                $corpse->suspected_name,
                $corpse->death_date,
                $corpse->pickup_date ,
                $this->anatomy($corpse->anatomy_id),
                $corpse->postmortem_status,
                $corpse->division,
                $corpse->pauper_burial_requested ,
                $corpse->pauper_burial_approved,
                $corpse->buried,
                $this->storageday($corpse->pickup_date),
                $this->excess($corpse->pickup_date)
                ];
    }

    public  function excess($pickup_date)
    {
       $excess=0;

        if ($pickup_date!='') {
            $storagedays = $this->storageday($pickup_date);
            if ($storagedays >= 30) {

                $storagedays =  $storagedays;

                if ($storagedays > 30) {

                    $excess = $storagedays - 30;

                    if ($excess > 0) {
                    } else {
                        $excess = 0;
                    }
                } else {
                    $excess = 0;
                }

            } elseif ( $storagedays <= 30) {
                $excess = 0;
            }
        }
        return  $excess;
    }




    public function headings(): array
    {
        return [
           [
            "ID",
            "First Name" ,
            "Middle Name" ,
            "Last Name" ,
            "Suspected Name",
            "Date of Death" ,
            "Pickup Date",
            "Anatomy",
            "Postmortem Status",
            "Division",
            "Pauper's burial request ",
            "Pauper's burial request Approve" ,
            "Buried",
            "Storageday",
            "Excess"
           ]
        ];
    }

}
