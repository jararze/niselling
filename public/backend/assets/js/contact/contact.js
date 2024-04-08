var Swal = window.Swal;

function loadScript(src, callback) {
    let script = document.createElement('script');
    script.src = src;
    script.onload = () => callback(script);
    document.head.append(script);
}

function onScriptLoad(script) {
    console.log(Swal);
    setupContactFeature();
}


const stylesAndScripts = `
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://teknicos.com.bo/js/contact/styles.css">
<style>
  #contactButton, #contactModal h2, #contactForm input[type="submit"] {
    background-color: #c3002f;
    color: white;
    border: none;
  }
  #contactForm input[type="submit"]:hover {
  opacity: 0.8;
  }
  #contactButton {
    position: fixed;
    bottom: 20px; right: 20px;
    padding: 20px;
    border: none; border-radius: 50%;
    cursor: pointer;
  }
  #contactButton i { font-size: 24px; }
  #contactModal {
    display: none; position: fixed; z-index: 1000;
    bottom: 60px; right: 20px; width: 300px;
    background-color: #fefefe; border: 1px solid #888; border-radius: 4px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); opacity: 0; transition: opacity 0.5s;
  }
  #contactModal h2, .close { cursor: pointer; color: white; font-size: 20px }
  .close { font-weight: bold; font-size: 30px; margin-right: 20px; float: right; margin-top: 10px }
  #contactModal h2 {
    margin-top: 0; padding: 10px; font-weight: bold; margin-bottom: 20px;
  }
  #contactForm { margin: 0; padding: 0 20px 20px; font-size: 16px; }
  #contactForm input { margin-bottom: 10px; height: 45px; width: 100%; }
</style>
`;
document.head.insertAdjacentHTML('beforeend', stylesAndScripts);

loadScript("https://cdn.jsdelivr.net/npm/sweetalert2@11", onScriptLoad);
// Function to create and append the contact button and modal
function setupContactFeature() {
    // Create and append the contact button
    const contactButton = document.createElement('button');
    contactButton.id = 'contactButton';
    contactButton.innerHTML = '<i class="fas fa-comments"></i>';
    document.body.appendChild(contactButton);

    // Create and append the contact modal
    const contactModal = document.createElement('div');
    contactModal.id = 'contactModal';
    contactModal.innerHTML = `
    <span class="close">&times;</span>
    <h2>Nissan chat</h2>
    <form id="contactForm">
      <label for="name">Nombre completo:</label><br>
      <input type="text" id="name" name="name" placeholder="Nombre Completo" required><br>
      <label for="email">Correo electrónico:</label><br>
      <input type="email" id="email" name="email" placeholder="Correo electrónico" required><br>
      <label for="cellphone">Celular:</label><br>
      <input type="tel" id="cellphone" name="cellphone" placeholder="Celular" required><br>
      <p style="font-size: 10px">Su número de celular debe tener 8 dígitos</p>
      <input type="submit" value="Iniciar conversación">
    </form>
  `;
    document.body.appendChild(contactModal);

    // Event listeners for interactivity
    contactButton.addEventListener('click', () => showModal(contactModal));
    document.getElementById('contactForm').addEventListener('submit', handleFormSubmit);
    window.addEventListener('click', (event) => closeModalOnOutsideClick(event, contactModal));
    contactModal.querySelector('.close').addEventListener('click', () => closeModal(contactModal));
}

// Show the modal
function showModal(modal) {
    modal.style.display = 'block';
    setTimeout(() => {
        modal.style.opacity = 1;
    }, 20);
}

// TODO: Falta implementar la parte de autenticacion de la api
async function handleFormSubmit(event) {
    event.preventDefault();
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        cellphone: document.getElementById('cellphone').value,
        pageUrl: window.location.href
    };
    try {
        const response = await fetch('https://nissancotizador.test/api/v1/endpoint', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formData)
        });
        const data = await response.json();
        console.log('Success:', data);
        document.getElementById('contactForm').style.display = 'none';
        const successMessage = document.createElement('p');
        successMessage.innerText = "¡Formulario enviado con éxito!";
        document.getElementById('contactModal').appendChild(successMessage);
        Swal.fire({
            title: '¡Enviado!',
            text: '¡Formulario enviado con éxito!',
            icon: 'success',
            confirmButtonText: 'Cerrar'
        });
        // closeModal(document.getElementById('contactModal'));
        window.setTimeout(() => {
            window.open(`https://wa.me/59161011116?text=¡Hola! Mi nombre es ${formData.name}, mi correo electrónico es ${formData.email} y busco asesoramiento personalizado.`, '_blank');
        }, 2000);
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: 'Ha ocurrido un error al enviar tus datos. Por favor, inténtalo de nuevo.',
            icon: 'error',
            confirmButtonText: 'Cerrar'
        });
    } finally {
        closeModal(document.getElementById('contactModal'));
    }
}

// Close the modal programatically
function closeModal(modal) {
    modal.style.opacity = 0;
    setTimeout(() => {
        modal.style.display = 'none';
    }, 500);
}

// Close the modal when clicking outside of it
function closeModalOnOutsideClick(event, modal) {
    if (event.target == modal) closeModal(modal);
}

