#build /dist
npm run build

#get the latest commit hash as a string
LOGSTRING=$(git log)
COMMIT=$(echo $LOGSTRING | awk '{print $2}') 

#navigato to dist
cd dist

git config --global user.email "nikolay.rusev21@gmail.com"
git config --global user.name "NikolayR21"

#init a repo and commit
git init
git add .
git commit -m "deploy (commit: $COMMIT)"

git push -f https://github.com/NikolayR21/web-programming-II-exam.git master:gh-pages
cd ..