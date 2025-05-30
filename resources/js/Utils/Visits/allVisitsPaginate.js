const token = sessionStorage.getItem('token');

const allVisitsPaginate = async (url = '/api/visit/pagination') => {
  const response = await fetch(url, {
    method: 'GET',
    credentials: 'include',
    headers: {
      Authorization: `Bearer ${token}`,
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    }
  });

  console.log(response.statusText);
  if (!response.ok) throw new Error("Error al listar las visitas paginadas");
  const data = await response.json();
  return data;
};

export default allVisitsPaginate;
