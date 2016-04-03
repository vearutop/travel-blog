SHELL := /bin/bash

git-status:
	find . -type d -name '.git' | while read dir ; do sh -c "cd $$dir/../ && echo -e \"\nGIT STATUS IN $${dir//\.git/}\" && git status -s" ; done

git-diff:
	find . -type d -name '.git' | while read dir ; do sh -c "cd $$dir/../ && echo -e \"\nGIT DIFF IN $${dir//\.git/}\" && git --no-pager diff" ; done
