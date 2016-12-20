import React, { Component } from 'react';
import Hello from '../containers/HelloWorld';

export default class App extends Component { // eslint-disable-line react/prefer-stateless-function
  render() {
    return (
      <div>
        <Hello />
      </div>
    );
  }
}

if (module.hot) {
  module.hot.accept();
}
