'use client';
import React, { useState, useEffect } from 'react';
import { useFiles } from "@/hooks/files";
import { Folder, File, RefreshCw } from 'lucide-react';

const Files = () => {
	const { fetch } = useFiles();
	const [files, setFiles] = useState([]);
	const [isLoading, setIsLoading] = useState(false);

	const fetchFiles = async () => {
		setIsLoading(true);
		try {
			const fetchedFiles = await fetch();
			setFiles(fetchedFiles.files);
		} catch (error) {
			console.error("Error fetching files:", error);
		} finally {
			setIsLoading(false);
		}
	};

	useEffect(() => {
		fetchFiles();
	}, []);

	return (
		<div className="container mx-auto p-6">
			<div className="bg-blue-100 rounded-lg p-6 mb-6 flex justify-between items-center">
				<h1 className="text-2xl font-bold text-blue-800">Files Uploaded</h1>
				<button
					onClick={fetchFiles}
					className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center"
					disabled={isLoading}
				>
					<RefreshCw className={`mr-2 h-4 w-4 ${isLoading ? 'animate-spin' : ''}`} />
					{isLoading ? 'Refreshing...' : 'Refresh'}
				</button>
			</div>

			{files.length > 0 ? (
				<div className="bg-white shadow-md rounded-lg overflow-hidden">
					<table className="min-w-full">
						<thead className="bg-gray-100">
						<tr>
							<th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
							<th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Name</th>
						</tr>
						</thead>
						<tbody className="divide-y divide-gray-200">
						{files.map((file, index) => (
							<tr key={index} className="hover:bg-gray-50">
								<td className="px-6 py-4 whitespace-nowrap">
									{file.endsWith('.jpg') || file.endsWith('.jpeg') || file.endsWith('.png') ? (
										<File className="text-blue-500" size={24} />
									) : (
										<Folder className="text-yellow-500" size={24} />
									)}
								</td>
								<td className="px-6 py-4 whitespace-nowrap">
									<span className="text-sm font-medium text-gray-900">{file}</span>
								</td>
							</tr>
						))}
						</tbody>
					</table>
				</div>
			) : (
				<div className="text-center text-gray-500 mt-4">
					{isLoading ? 'Loading files...' : 'No files found.'}
				</div>
			)}
		</div>
	);
}

export default Files;
