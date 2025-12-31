document.addEventListener('change', function(e) {
        if (!e.target.classList.contains('calling-type')) return;

        const modal = e.target.closest('.modal-body');

        modal.querySelector('.followup-date').classList.add('d-none');
        modal.querySelector('.followup-datetime').classList.add('d-none');

        const type = e.target.dataset.requireDate;

        if (type === 'date') {
            modal.querySelector('.followup-date').classList.remove('d-none');
        }

        if (type === 'datetime') {
            modal.querySelector('.followup-datetime').classList.remove('d-none');
        }
    });







    