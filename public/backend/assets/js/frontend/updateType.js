document.addEventListener('DOMContentLoaded', function () {
    const quote_id = document.getElementById('quote_id');
    const EndPoint = window.Laravel.submitEndpoint.replace(':id', quote_id.value);
    const thanksEndPoint = window.Laravel.thanksPoint.replace(':id', quote_id.value);
    document.querySelector("#whatapp_contact").addEventListener('click', (e) => {
        e.preventDefault();
        let hreff = e.target.href;
        console.log(EndPoint)
        fetch(EndPoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                id: quote_id.value,
            })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.success)
                if (data.success) {
                    window.open(hreff, '_blank');
                    window.location.href = thanksEndPoint;
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });
});


