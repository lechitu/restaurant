export const CafeTypeFilter = {
  methods: {
    /*
      Determines if the cafe should show based off of type.
    */
    processCafeTypeFilter( cafe, type ){
      /*
        Switch the active type.
      */
      switch( type ){
        /*
          If the cafe is a restaurant and the restaurant filter is
          selected, show the cafe.
        */
        case 'restaurant':
          if( cafe.company.restaurant == 1 ){
            return true;
          }else{
            return false;
          }
        break;

        /*
          If the cafe is not a restaurant and general cafe is selected,
          show the cafe.
        */
        case 'cafes':
          if( cafe.company.restaurant == 0 ){
            return true;
          }else{
            return false;
          }
        break;

        /*
          If all is selected, show the cafe.
        */
        case 'all':
          return true;
        break;
      }
    }
  }
}
