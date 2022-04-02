const d = document,
  $addForm = d.querySelector('.add-form'),
  $editForm = d.querySelector('.edit-form'),
  $editInputs = d.querySelectorAll('.edit-form input')

async function getData (id) {
  var fd = new FormData()
  fd.append('id', id)

  data = await fetch(
    'http://localhost:8080/practice/customer/getCustomerById',
    {
      method: 'POST',
      body: fd // send form
    }
  )
    .then(res => res.json())
    .then(json => json)

  renderData(data)
}

function customerForm () {
  $editInputs.forEach(input => {
    const $span = d.createElement('span')

    $span.id = input.name
    $span.textContent = input.title
    $span.classList.add('contact-form-error', 'none')

    input.insertAdjacentElement('afterend', $span)
  })

  getData(1)
}

function renderData (data) {
  console.log(data)
  // var databody = document.querySelector('#databody')
  // let total = 0
  // databody.innerHTML = ''
  // data.forEach(item => {
  //   //total += item.amount;
  //   databody.innerHTML += `<tr>
  //             <td>${item.title}</td>
  //             <td><span class="category" style="background-color: ${item.color}">${item.name}</span></td>
  //             <td>${item.date}</td>
  //             <td>$${item.amount}</td>
  //             <td><a href="http://localhost/system/expenses/delete/${item.id}">Eliminar</a></td>
  //         </tr>`
  // })
}

d.addEventListener('DOMContentLoaded', customerForm)

// Add customer
$addForm.addEventListener('submit', async e => {
  e.preventDefault()

  let names = e.target.names.value,
    lastName = e.target.lastName.value,
    lastName2 = e.target.lastName2.value,
    address = e.target.address.value,
    email = e.target.email.value

  if (
    names === '' ||
    lastName === '' ||
    lastName2 === '' ||
    address === '' ||
    email === ''
  ) {
    alert('Todos los campos son obligatorios')
    return
  }

  // validated email

  var fd = new FormData()
  fd.append('id', e.target.id.value)
  fd.append('names', e.target.names.value)
  fd.append('lastName', e.target.lastName.value)
  fd.append('lastName2', e.target.lastName2.value)
  fd.append('address', e.target.address.value)
  fd.append('email', e.target.email.value)

  await fetch('http://localhost:8080/practice/customer/updateCustomer', {
    method: 'POST',
    body: fd // send form
  })
    .then(res => (res.ok ? res.json() : Promise.reject(res)))
    .then(json => {
      console.log(json)

      $addForm.reset()
    })
    .catch(err => {
      console.log(err)
      const message =
        err.statusText || 'There was an error sending, please try again'

      //$response.innerHTML = `<p>Error ${err.status}: ${message}</p>`;
    })
    .finally(() => {
      // setTimeout(() => {
      //   $response.classList.add('none');
      //   $response.innerHTML = '';
      // }, 3000)
    })
})

// Edit customer
$editForm.addEventListener('submit', async e => {
  e.preventDefault()

  let names = e.target.names.value,
    lastName = e.target.lastName.value,
    lastName2 = e.target.lastName2.value,
    address = e.target.address.value,
    email = e.target.email.value

  if (
    names === '' ||
    lastName === '' ||
    lastName2 === '' ||
    address === '' ||
    email === ''
  ) {
    alert('Todos los campos son obligatorios')
    return
  }

  // validated email

  var fd = new FormData()
  fd.append('id', e.target.id.value)
  fd.append('names', e.target.names.value)
  fd.append('lastName', e.target.lastName.value)
  fd.append('lastName2', e.target.lastName2.value)
  fd.append('address', e.target.address.value)
  fd.append('email', e.target.email.value)

  await fetch('http://localhost:8080/practice/customer/updateCustomer', {
    method: 'POST',
    body: fd // send form
  })
    .then(res => (res.ok ? res.json() : Promise.reject(res)))
    .then(json => {
      console.log(json)

      $editForm.reset()
    })
    .catch(err => {
      console.log(err)
      const message =
        err.statusText || 'There was an error sending, please try again'

      //$response.innerHTML = `<p>Error ${err.status}: ${message}</p>`;
    })
    .finally(() => {
      // setTimeout(() => {
      //   $response.classList.add('none');
      //   $response.innerHTML = '';
      // }, 3000)
    })
})

/* Delete customer */
d.addEventListener('click', e => {
  e.preventDefault()

  if (e.target.matches('.btn')) {
    const $tr = e.target.parentElement.parentElement

    // comparing attributes vs dataset
    // console.log($tr.getAttribute('data-id'))
    console.log($tr.dataset.id)

    // Delete
    if (e.target.matches('.btn-delete')) {
      const id = $tr.dataset.id
      const fd = new FormData()
      fd.append('id', id)

      fetch('http://localhost:8080/practice/customer/delete', {
        method: 'POST',
        body: fd
      })
        .then(res => res.json())
        .then(json => {
          console.log(json)
          if (json.status === 'success') {
            $tr.remove()
          }
        })
    }

    // Edit
    else if (e.target.matches('.btn-edit')) {
      const id = $tr.dataset.id

      fetch('http://localhost:8080/practice/customer/getCustomerById', {
        method: 'POST',
        body: fd
      })
        .then(res => res.json())
        .then(json => {
          console.log(json)

          $inputs.forEach(input => {
            input.value = json[input.name]
          })

          $editForm.querySelector('#id').value = id
          $editForm.querySelector('#names').focus()
          // $editForm.querySelector('#names').value = json.names
          // $editForm.querySelector('#lastName').value = json.lastName
          // $editForm.querySelector('#lastName2').value = json.lastName2
          // $editForm.querySelector('#address').value = json.address
          // $editForm.querySelector('#email').value = json.email
        })
    }
  }
})

/* ------------------------------------------------------------------ */
{
  /* 
<form id="customer-form">
</form> 
*/
}
// Estudiar el uso de
// const $form = d.getElementById('customer-form')

// d.addEventListener('click', e => {
//   if (e.target === $form.close) {
//     // close window
//     tester.close()
//   }
// })

/* ------------------------------------------------------------------ */
/***** HTML AJAX Exercises - APIs: Song Finder with Fetch + Async */
{
  /* <form id="song-search">
      <input
        type="text"
        name="artist"
        placeholder="Interpreter's name"
        required
      />
      <br />
      <input type="text" name="song" placeholder="Name of the song" required />
      <br />
      <input type="submit" value="Search" />
    </form> */
}
// $form = d.getElementById('song-search')

// $form.addEventListener('submit', async e => {
//   e.preventDefault()

//   let artistQuery = e.target.artist.value.toLowerCase(),
//     songQuery = e.target.song.value.toLowerCase()
// })

// ------------------------------Example of add------------------------------------
/***** HTML AJAX Exercises - APIs: Song Finder with Fetch + Async */
{
  /* <form id="todo-form">
      <input type="text" id="todo-item" placeholder="tasks todo" />
      <input type="submit" value="Add" />
    </form> */
  // const $list = d.getElementById('todo-list')
  // const $list = d.querySelector('.edit-form')
  // d.addEventListener('submit', e => {
  //   // if (!e.target.matches('#todo-form')) return false
  //   if (!e.target.matches('table tbody')) return false
  //   e.preventDefault()
  //   // add item in the list
  //   const $tr = d.createElement('tr'),
  //     $td = d.createElement('td')
  //   $td.textContent = $item.value
  //   $tr.appendChild($td)
  //   $list.appendChild($tr)
  //   // clean input
  //   // $item.value = ''
  //   // $item.focus()
  // })
}
