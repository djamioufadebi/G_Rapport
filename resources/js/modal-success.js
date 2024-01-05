document.addEventListener('livewire:load', function () {
    Livewire.hook('message.sent', () => {
        $('.modal').modal('show');
    });
});

