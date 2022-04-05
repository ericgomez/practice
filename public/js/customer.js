const d = document,
  $editForm = d.querySelector('.edit-form'),
  $editInputs = d.querySelectorAll('.edit-form input'),
  $addForm = d.querySelector('.add-form'),
  $list = d.getElementById('customer-list'),
  $numItems = d.querySelectorAll('#customer-list tr').length

/* Delete customer */
d.addEventListener('click', e => {
  // Delete
  if (e.target.matches('.btn-delete')) {
    e.preventDefault()
    const $tr = e.target.parentElement.parentElement
    const id = $tr.dataset.id

    const data = new FormData()
    data.append('id', id)

    fetch('http://localhost:8080/practice/customer/delete', {
      method: 'POST',
      body: data
    })
      .then(res => res.json())
      .then(json => {
        // console.log(json)
        if (json.status === 'success') {
          $tr.remove()
        }
      })
  } else if (e.target.matches('.btn-edit')) {
    e.preventDefault()
    const $tr = e.target.parentElement.parentElement
    const id = $tr.dataset.id

    const data = new FormData()
    data.append('id', id)

    fetch('http://localhost:8080/practice/customer/getCustomerById', {
      method: 'POST',
      body: data
    })
      .then(res => res.json())
      .then(json => {
        // console.log(json)
        // $editForm.dataset.id = id

        $editInputs[0].value = json.data.id
        $editInputs[1].value = json.data.names
        $editInputs[2].value = json.data.lastName
        $editInputs[3].value = json.data.lastName2
        $editInputs[4].value = json.data.address
        $editInputs[5].value = json.data.email

        // $editInputs.forEach((input) => {
        //   const $span = d.createElement('span');

        //   $span.id = input.name;
        //   $span.textContent = input.title;
        //   $span.classList.add('contact-form-error', 'none');

        //   input.insertAdjacentElement('afterend', $span);
        // });
      })
  }
})

$editForm.addEventListener('submit', e => {
  e.preventDefault()

  let id = e.target.id.value,
    names = e.target.names.value,
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

  fetch('http://localhost:8080/practice/customer/updateCustomer', {
    method: 'POST',
    body: new FormData(e.target)
  })
    .then(res => (res.ok ? res.json() : Promise.reject(res)))
    .then(json => {
      // console.log(json)

      if (json.status === 'success') {
        const elem = d.querySelector('[data-id="' + id + '"]')

        elem.querySelector('td:nth-child(2)').textContent = names
        elem.querySelector('td:nth-child(3)').textContent = lastName
        elem.querySelector('td:nth-child(4)').textContent = lastName2
        elem.querySelector('td:nth-child(5)').textContent = address
        elem.querySelector('td:nth-child(6)').textContent = email
      }

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

$addForm.addEventListener('submit', e => {
  e.preventDefault()

  let id = e.target.id.value,
    names = e.target.names.value,
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

  fetch('http://localhost:8080/practice/customer/newCustomer', {
    method: 'POST',
    body: new FormData(e.target)
  })
    .then(res => (res.ok ? res.json() : Promise.reject(res)))
    .then(json => {
      if (json.status === 'success') {
        // if (!e.target.matches('#todo-form')) return false
        // if (!e.target.matches('table tbody')) return false
        e.preventDefault()

        // add item in the list
        let $tr = d.createElement('tr'),
          $tdId = d.createElement('td'),
          $tdNames = d.createElement('td'),
          $tdLastName = d.createElement('td'),
          $tdLastName2 = d.createElement('td'),
          $tdAddress = d.createElement('td'),
          $tdEmail = d.createElement('td')

        $tdId.textContent = json.data.customer
        $tdNames.textContent = names
        $tdLastName.textContent = lastName
        $tdLastName2.textContent = lastName2
        $tdAddress.textContent = address
        $tdEmail.textContent = email

        $tr.appendChild($tdId)
        $tr.appendChild($tdNames)
        $tr.appendChild($tdLastName)
        $tr.appendChild($tdLastName2)
        $tr.appendChild($tdAddress)
        $tr.appendChild($tdEmail)

        $list.appendChild($tr)

        // $item.focus()
      }

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
