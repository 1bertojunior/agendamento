function getTheme(){
    const prefersColorScheme = window.matchMedia('(prefers-color-scheme: dark)');
    
    if( prefersColorScheme.matches ) {
        alert('Dark') // O tema é o dark
    } else {
        alert('!Dark') // O tema é o light
    }
}