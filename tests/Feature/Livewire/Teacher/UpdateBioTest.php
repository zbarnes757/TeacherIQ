<?php

use Livewire\Volt\Volt;

it('can render', function (): void {
    $component = Volt::test('teacher.update-bio');

    $component->assertSee('');
});
