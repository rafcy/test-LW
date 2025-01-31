
export function getFileNameFromPath(filePath: string): string {
    const fileName = filePath.split('/');

    return fileName[fileName.length - 1].split('.')[0];
}
