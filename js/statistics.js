function findN(data) {
    return data.length;
}

function findSum(data) {
    var total = 0;
    for (var i = 0; i < findN(data); i++) {
        total += data[i];
    }
    return total.toFixed(2);
}

function findMean(data) {
    return (findSum(data) / findN(data)).toFixed(2);
}

function findMedian(data) {
    var median = 0,
        length = findN(data);

    if (length % 2 === 0) {
        median = (data[length/2] + data[(length / 2) - 1]) / 2;
    } else {
        median = data[(length - 1) / 2];
    }
    return median;
}

function findMode(data) {
    var modes = [],
        count = [],
        max = 0;
    for (var i = 0; i < findN(data); i += 1) {
        var number = data[i];
        count[number] = (count[number] || 0) + 1;
        if (count[number] > max) {
            max = count[number];
        }
    }
    for (i in count) if (count.hasOwnProperty(i)) {
        if (count[i] === max) {
            modes.push(Number(i)+ ",");
        }
    }
    return modes;
}

function findVariance(data) {
    var mean = findMean(data);
    return (findSum(data.map(function(sum) {
        return Math.pow(sum - mean, 2);
    })) / (findN(data) -1)).toFixed(2);
}

function findStandardDeviation(data) {
    return Math.sqrt(findVariance(data)).toFixed(2);
}