const token = sessionStorage.getItem('token')
const showUser = async (id) => {
    const response = await fetch(`/api/user/${id}`, {
        method: 'GET',
        credentials: 'include',
        headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    });

    console.log(response)
    if (!response.ok) throw new Error('Error al consultar un usuario');

    const data = await response.json();
    console.log(data)
    return data;
}

export default showUser;
