<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerWqpbjI0\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerWqpbjI0/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerWqpbjI0.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerWqpbjI0\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerWqpbjI0\App_KernelDevDebugContainer([
    'container.build_hash' => 'WqpbjI0',
    'container.build_id' => '436b7e28',
    'container.build_time' => 1717286886,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerWqpbjI0');
