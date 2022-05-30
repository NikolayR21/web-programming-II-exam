#build /dist
npm run build

#get the latest commit hash as a string
LOGSTRING=$(git log)
COMMIT=$(echo $LOGSTRING | awk '{print $2}') 

#navigato to dist
cd dist

#init a repo and commit
git init
git add .
git commit -m "deploying commit"

git push https://${{ secrets.GITHUB_TOKEN }}@github.com/NikolayR21/web-programming-II-exam.git master:gh-pages
cd ..