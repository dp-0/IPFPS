<?php

namespace App\Http\Controllers;

use App\Models\Fir;
use App\Models\Suspect;
use App\Models\Witness;
use Illuminate\Http\Request;

class SimilarFirListController extends Controller
{   
    public function index(Request $request, $id)
    {
        $fir = Fir::where('id', $id)->first();
        $similarFir = $this->findSimilarFIRs($fir);
        
    }

    function findSimilarFIRs($newFIR) {
        // Retrieve all FIRs from the database
        $allFIRs = FIR::all();
        $newSuspect = Suspect::where('fir_id','=',$newFIR->id)->first();
        // Initialize an array to store the similarity scores
        $similarityScores = [];
    
        // Loop through all FIRs
        foreach ($allFIRs as $oldFIR) {

            // Compute similarity for incident type
            $incidentTypeSimilarity = ($newFIR->incident_type_id == $oldFIR->incident_type_id) ? 1 : 0;
    
            // Compute similarity for location
            $locationSimilarity = 1 / (1 + sqrt(pow($newFIR->latitude - $oldFIR->latitude, 2) + pow($newFIR->longitude - $oldFIR->longitude, 2)));
    
            // Compute similarity for complainant
            $complainantSimilarity = ($newFIR->complain_by == $oldFIR->complain_by) ? 1 : 0;
            // Compute similarity for incident details
     
            $descriptionSimilarity = $this->computeTextSimilarity($newFIR->incident_details, $oldFIR->incident_details);
            // Compute similarity for suspects
            $suspect = Suspect::where('fir_id','=',$oldFIR->id)->first();
            $suspectSimilarity = $this->computeEntitySimilarity($newSuspect, $suspect);

            // Combine the similarities into a composite similarity
            $compositeSimilarity = 0.16 * $incidentTypeSimilarity + 0.16 * $locationSimilarity + 0.16 * $complainantSimilarity + 0.16 * $descriptionSimilarity + 0.16 * $suspectSimilarity;

            // Store the composite similarity
            $similarityScores[$oldFIR->id] = $compositeSimilarity*100;
        }
    
        // Sort the FIRs by similarity score in descending order
        arsort($similarityScores);
        // Get the IDs of the 5 most similar FIRs
        $similarFIRIds = array_slice(array_keys($similarityScores), 0, 10);
        // Retrieve the most similar FIRs from the database
     
        return $similarFIRIds;
    }
    
    function computeEntitySimilarity($newEntity, $oldEntity) {
        if(!$newEntity || !$oldEntity) return 0;
        // Initialize the total similarity
        $totalSimilarity = 0;
        // Loop through all pairs of entities

        $nameSimilarity = ($newEntity->name == $oldEntity->name) ? 1 : 0;
    
        // Compute similarity for age
        $ageSimilarity = 1 / (1 + abs($newEntity->age - $oldEntity->age));

        // Compute similarity for gender
        $genderSimilarity = ($newEntity->gender == $oldEntity->gender) ? 1 : 0;

        // Compute similarity for address
        $addressSimilarity = $this->computeTextSimilarity($newEntity->address, $oldEntity->address);

        // Compute similarity for nationality
        $nationalitySimilarity = ($newEntity->nationality == $oldEntity->nationality) ? 1 : 0;

        // Combine the similarities into a composite similarity
        // $compositeSimilarity = 0.2 * $nameSimilarity + 0.2 * $ageSimilarity + 0.2 * $genderSimilarity + 0.2 * $addressSimilarity + 0.2 * $nationalitySimilarity;
        $compositeSimilarity = 0.2 * $nameSimilarity + 0.2 * $ageSimilarity + 0.2 * $genderSimilarity + 0.2 * $addressSimilarity + 0.2 * $nationalitySimilarity;

        // Add the composite similarity to the total similarity
        $totalSimilarity += $compositeSimilarity;

        return $totalSimilarity;
    }
    
    function computeTextSimilarity($text1, $text2) {
        // Split the texts into words
        $words1 = explode(' ', $text1);
        $words2 = explode(' ', $text2);
    
        // Compute the word frequencies
        $freq1 = array_count_values($words1);
        $freq2 = array_count_values($words2);
    
        // Compute the dot product
        $dotProduct = 0;
        foreach ($freq1 as $word => $freq) {
            if (isset($freq2[$word])) {
                $dotProduct += $freq * $freq2[$word];
            }
        }
        // Compute the magnitudes
        $magnitude1 = sqrt(array_sum(array_map(function($freq) { return $freq * $freq; }, $freq1)));
        $magnitude2 = sqrt(array_sum(array_map(function($freq) { return $freq * $freq; }, $freq2)));
    
        // Compute the cosine similarity
        $cosineSimilarity = $dotProduct / ($magnitude1 * $magnitude2);
        return $cosineSimilarity;
    }
}
