# New Project

## CakePHP プロジェクトの作成

```
cd .
docker run --rm -it -v $(pwd):/home/app -w /home/app katsuhikonagashima/php-fpm-base:7.4-buster /bin/bash
```

```
apt-get install -y curl
curl -sS https://getcomposer.org/installer | php

php composer.phar create-project --prefer-dist cakephp/app:4.* cakephp4-vue3-study

mv composer.phar ./cakephp-vue-template/
mv cakephp4-vue3-study backend
exit
```

```
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin git@github.com:katsuhiko/cakephp4-vue3-study.git
git push -u origin main
```

