import configureStore from '../common/store/configureStore';
import App from '../common/components/App';

global.App = App;
global.configureStore = configureStore;

// export App and configureStore
// SSR component only
