document.addEventListener('DOMContentLoaded', function () {
    const quote_id = document.getElementById('quote_id');
    // Las URLs llegan firmadas y completas desde el blade: la firma cubre la
    // URL exacta, así que ya no se arma con un patrón :id + replace().
    const EndPoint = window.Laravel.submitEndpoint;
    const thanksEndPoint = window.Laravel.thanksPoint;
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


