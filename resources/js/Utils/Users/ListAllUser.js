const token = sessionStorage.getItem('token');

const allUser = async () => {
  const response = await fetch('/api/user', {
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
  if (!response.ok) throw new Error('Error al obtener usuarios');
  const data = await response.json();
  return data;
};

export default allUser;
