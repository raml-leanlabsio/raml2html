<?php

namespace Cnam\Raml\SecurityScheme;

use Cnam\Raml\SecurityScheme\SecuritySettings\JwtSecuritySettngs;
use Raml\SecurityScheme\SecuritySettingsParserInterface;

class JwtSecurityParser implements SecuritySettingsParserInterface
{
    // ---
    // SecuritySettingsParserInterface

    /**
     * Create a new OAuth1 Security Settings Object from array data
     *
     * @param array $data
     * [
     *  requestTokenUri:     ?string
     *  authorizationUri:    ?string
     *  tokenCredentialsUri: ?string
     * ]
     *
     * @return JwtSecuritySettngs
     */
    public function createSecuritySettings(array $data = [])
    {
        $securitySetting = new JwtSecuritySettngs();

        return $securitySetting;
    }

    /**
     * Get a list of supported types
     *
     * @return array
     */
    public function getCompatibleTypes()
    {
        return [JwtSecuritySettngs::TYPE];
    }
}
