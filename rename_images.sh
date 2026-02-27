#!/bin/bash
cd public/images
for f in *; do
  # Replace spaces with underscores, remove parentheses
  new_name=$(echo "$f" | tr ' ' '_' | tr -d '()')
  if [ "$f" != "$new_name" ]; then
    mv "$f" "$new_name"
    echo "Renamed: '$f' -> '$new_name'"
  fi
done
