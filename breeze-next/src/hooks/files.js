import axios from "@/lib/axios"

export const useFiles = () => {
	const fetch = async() => {
		const response = await axios.get('/files')
		return response.data
	}

	return { fetch };
}
