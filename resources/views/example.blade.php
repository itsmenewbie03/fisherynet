{{-- example.blade.php --}}
<?php
    echo "hello";
?>
<div class="test">I am a div</div>
@servers(['web' => ['user@192.168.1.1']])

@task('deploy', ['on' => 'web'])
    cd /home/user/example.com
    @if($branch)
        git pull origin {{ echo "hello" }}
    @endif
    php arisan migrate --force
@endtask
