<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('teacher.update-bio');

    $component->assertSee('');
});
