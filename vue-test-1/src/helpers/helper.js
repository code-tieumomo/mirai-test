export function addParents(data, parents = []) {
    return data.map(item => {
        const newItem = { ...item, parents };
        if (item.children && item.children.length > 0) {
            newItem.children = addParents(item.children, [...parents, item.id]);
        }
        return newItem;
    });
}

export function getAllFiles(folder, member = [], search = "") {
    let result = [];

    function traverse(node) {
        if (node.children && node.children.length > 0) {
            node.children.forEach(child => traverse(child));
        } else if (node.children === undefined) {
            result.push({
                id: node.id,
                name: node.name,
                url: node.url,
                type: node.type,
                dimension: node.dimmension,
                size: node.size,
                photo_by: node.photo_by
            });
        }
    }

    folder.children?.forEach(folder => traverse(folder));

    return result.filter((item) => {
        let condition = true;

        if (search !== "") {
            condition = item.name.toLowerCase().includes(search.toLowerCase());
        }

        if (member.length > 0) {
            condition = condition && (member.includes("All") || member.includes(item.photo_by));
        }

        return condition;
    });
}

export function calculateTotalSize(folder) {
    let totalSize = 0;

    folder.forEach(item => {
        if (item.size) {
            totalSize += parseInt(item.size, 10);
        }

        if (item.children && item.children.length > 0) {
            totalSize += calculateTotalSize(item.children);
        }
    });

    return totalSize;
}

export function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return "0 Bytes";

    const k = 1000;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ["Bytes", "KB", "MB", "GB"];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
}

export function roundDecimal(number, decimal = 2) {
    return parseFloat(number.toFixed(decimal));
}