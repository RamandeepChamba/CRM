<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
 
trait DeleteEmployeeTrait {
 
    public function deleteEmployee($employee) {
        // Delete avatar
        if ($this->avatarExist($employee->avatar)) {
            $this->removeAvatar($employee->avatar);
        }

        // Delete employee
        $employee->delete();
    }
    
    private function avatarExist($url)
    {
        if(!$url) {
            return 0;
        }
        // http://localhost/storage/logos/DWQYwRyn7M5k3tLm6DprlkI5YS7IoV18m7EXjFg5.jpg"
        $path = explode('/storage/', $url);
        return Storage::disk('public')->exists($path[1] ?? $path[0]);
    }
    private function removeAvatar($url)
    {
        // http://localhost/storage/logos/DWQYwRyn7M5k3tLm6DprlkI5YS7IoV18m7EXjFg5.jpg"
        $path = explode('/storage/', $url);
        Storage::disk('public')->delete($path[1]);
    }
}