<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    // Method & function controller 
    
    // A controll is like a project manager or dispatcher 
    // A request comes in and the controller makes sort of the top level big picture decisions 

    // It deligates responsobollites to others to get the job done 

    // Passing data from the controller to the view 
    public function homepage () {

        // loading data from db D
        // Complexity any sort of data loadig should be going in the controller not in the view 

        // The view is not asking the database for anything & not doing anything complex 
        // The view jsut recives data that is given to it 

        // CONTROLLER DOES EVERYTHING OF COMPLEXITY 
        $name = "Liam";

        $pets = ["dog", "cat", "big"];

        return view("homepage", ["name" => $name, "pets" => $pets]);
    }

    public function aboutpage () {
        return view("single-post");
    }
}
