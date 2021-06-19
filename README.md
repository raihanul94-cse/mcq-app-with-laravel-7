git clone --depth=1 --branch=master git@github.com:Zizaco/laravel-project.git <projectName>
cd !$
rm -rf .git
composer run-script post-root-package-install
composer install
composer run-script post-create-project-cmd
