# Script para fixar o funcionamento do .gitignore 
# para a pasta vendor, commitada no inicio do projeto

git rm -r --cached .

git add .

git commit -m "Fix File .gitignore"

perl -p -e 's/\r/\n/g' < .gitignore > .gitignore-new

mv .gitignore-new .gitignore

git add .

git commit -m "Fix File .gitignore Endings"
