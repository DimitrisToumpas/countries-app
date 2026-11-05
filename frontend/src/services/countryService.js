const API_URL = 'http://127.0.0.1:8000/api';

export async function getCountries() {
    const response = await fetch(`${API_URL}/countries`);

    if (!response.ok) {
        throw new Error('Failed to fetch countries');
    }

    return await response.json();
}