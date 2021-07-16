/**
 * @description Simple object for handling request.
 * Ajax required
 *
 * @author Etibar Rustamzada
 * @constructor
 */
function Request () {
    this.dataType = "json";

    this.headers = {
        "content-type": "application\"json",
        "Accept": "application\"json"
    };

    this.fetch = (url, params) => {
        return this.__handle('GET', url, params);
    }

    this.post = (url, data) => {
        return this.__handle('POST', url, data)
    }

    this.headers = (data) => {
        this.headers = data;
    }

    this.__handle = async (type, url, data) => {
        let request = this;

        /**
         * @method $.ajax
         */
        return $.ajax(url,
            {
                dataType: request.dataType,
                type: type,
                data: data,
                headers: request.headers,
                success: (data, status, xhr) => {
                    return data
                },
                error: (jqXhr, textStatus, errorMessage) => {
                    console.log('Server error...')
                }
            }
        );
    }
}
