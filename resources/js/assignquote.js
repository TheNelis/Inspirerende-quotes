let quotes = window.data['data'];

const column1 = document.getElementById("quotecolumn-1");
const column2 = document.getElementById("quotecolumn-2");
const column3 = document.getElementById("quotecolumn-3");
let column1Y;
let column2Y;
let column3Y;
let columns;


let biggestId = (function() {

    let index = 0;
    let max = quotes[index].id; //0
    for (let i = 1; i < quotes.length; i++){
        if (quotes[i].id >= max){
            max = quotes[i].id;
            index = i;
        }
    }
    return max;
})();

let startId = biggestId;

for (let i = 1; i < biggestId + 1; i++) {

    column1Y = column1.offsetHeight;
    column2Y = column2.offsetHeight;
    column3Y = column3.offsetHeight;
    let columns = [column3Y, column2Y, column1Y];
    
    let quotecard = document.getElementById("quote" + startId);

    if (quotecard) {
        let shortestColumn;
    
        shortestColumn = (function() {
            let column;

            //Check index in array
            let index = 0;
            let min = columns[index]; //0
            for (let i = 1; i < columns.length; i++){
                if (columns[i] <= min){
                    min = columns[i];
                    index = i;
                }
            }

            //Link shortest column
            if (index == 0) {
                column = column3; 
            } else if (index == 1) {
                column = column2;
            } else {
                column = column1;
            }

            return column;
        })();

        shortestColumn.appendChild(quotecard);

    } else {
        
    }

    startId--;
};