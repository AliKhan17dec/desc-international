$files = Get-ChildItem -Path "public/images" -File
foreach ($file in $files) {
    $newName = $file.Name -replace "\s+", "_" -replace "\(", "" -replace "\)", ""
    if ($file.Name -ne $newName) {
        Write-Output "Renaming: $($file.Name) -> $newName"
        Rename-Item -Path $file.FullName -NewName $newName
    }
}
