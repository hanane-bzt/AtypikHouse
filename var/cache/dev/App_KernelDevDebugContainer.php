<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerRRtTwMy\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerRRtTwMy/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerRRtTwMy.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerRRtTwMy\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerRRtTwMy\App_KernelDevDebugContainer([
    'container.build_hash' => 'RRtTwMy',
    'container.build_id' => '2d1585fd',
    'container.build_time' => 1716811937,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerRRtTwMy');