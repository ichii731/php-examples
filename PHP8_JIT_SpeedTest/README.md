## PHP8 JIT SpeedTest
@author: ichii731

### Detail
0115765.com

### Result
See **`php8_jit_result.csv`**

### Config

```powershell
wsl --list --verbose
  NAME                   STATE           VERSION
  Ubuntu                 Running         1
```

```shell
$ php -v
PHP 8.0.14 (cli)

$ php  -i | grep opcache.enable_cl
opcache.enable_cli => On => On

$ php -i | grep opcache.jit*
# 省略
```