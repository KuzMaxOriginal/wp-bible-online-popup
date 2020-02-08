# target path
$path = "."

# construct archive path
$DateTime = (Get-Date -Format "yyyyMMddHHmmss")
$destination = Join-Path $path ".\release\bible-online-popup-$DateTime.zip"

# exclusion rules. Can use wild cards (*)
$exclude = @(".*","README.md","build-release.ps1")

# get files to compress using exclusion filer
$files = Get-ChildItem -Path $path -Exclude $exclude

# make dir if not exists
New-Item -ItemType Directory -Force -Path ".\release\"

# compress
Compress-Archive -Path $files -DestinationPath $destination -CompressionLevel Fastest