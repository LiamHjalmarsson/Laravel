<?php
    namespace App\Models; 

    // We want a namespae So that we can access it from other files 
    class Listing {

        public static function all () {
            return [
                [            
                    "id" => 1,
                    "title" => "Listing one",
                    "description" => "Do you want to list"
                ], 
                [            
                    "id" => 2,
                    "title" => "Listing number 2",
                    "description" => "Why do you do this"
                ], 
            ];
        }

        public static function find ($id) {
            // When you have a class and want to call another method or property you can use self in a static fc 
            $listings = self::all();

            foreach($listings as $listing) {
                if ($listing["id"] == $id) {
                    return $listing;
                }
            }
        }
    }
?>