const token =sessionStorage.getItem('token')
const createUser = async(data) => {
    try {
        const response = await fetch('/api/user', {
            method: 'POST',
            credentials: 'include',
            headers: {
                Authorization: `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });

        const respo = await response.json();
        return respo.message

    } catch (error) {
        return error.message
    }

}

export default createUser
