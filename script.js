// we need to find the planets with having the friendly and also where the gates are reachable

let planets_names = [];

function printVisited(planets) {
  let visited_planets = [];
  planets.forEach((element) => {
    if (element.info != "unknown") {
      visited_planets.push(element.name);
    }
  });
  return visited_planets;
}

console.log("Visited planets " + printVisited(planets));

function countVisited(planets) {
  let count = 0;
  planets.forEach((element) => {
    if (element.info == "unknown") {
      count = count + 1;
    }
  });
  return count;
}

console.log("sg-1 need to visit " + countVisited(planets));

function findAllies(planets) {
  let output = [];
  planets.forEach((elem) => {
    if (elem.gate == "Reachable" && elem.info == "Friendly") {
      output.push(elem.name);
    }
  });
  return output;
}

planets_names = findAllies(planets);
console.log("allies of the earth " + planets_names);
