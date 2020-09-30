<?php
namespace PolygonIO\rest\stocks;

use PolygonIO\rest\RestResource;

class HistoricQuotesV2 extends RestResource {
    protected $defaultParams = [
        'limit' => 100
    ];
    public function get($tickerSymbol, $date, $params = []) {
        return $this->_get('/v2/ticks/stocks/nbbo/'.$tickerSymbol.'/'.$date, $params);
    }

    protected function mapper($response)
    {
        if ($response['results']) {
            $response['results'] = array_map(function ($result) {
                //$result['ticker'] = $result['T'];
                $result['SIPTimestamp'] = $result['t'] ?? NULL;
                $result['participantExchangeTimestamp'] = $result['y'] ?? NULL;
                $result['tradeReportingFacilityTimestamp'] = $result['f'] ?? NULL;
                $result['sequenceNumber'] = $result['q'] ?? NULL;
                $result['conditions'] = $result['c'] ?? NULL;
                $result['indicators'] = $result['i'] ?? NULL;
                $result['bidPrice'] = $result['p'] ?? NULL;
                $result['bidExchangeId'] = $result['x'] ?? NULL;
                $result['bidSize'] = $result['s'] ?? NULL;
                $result['askPrice'] = $result['p'] ?? NULL;
                $result['askExchangeId'] = $result['X'] ?? NULL;
                $result['askSize'] = $result['S'] ?? NULL;
                $result['tapeWhereTradeOccured'] = $result['z'] ?? NULL;
                return $result;
            }, $response['results']);
        }
        return $response;
    }
}
